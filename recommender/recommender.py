# -*- coding: utf-8 -*-

import os
import sys
import time

import MySQLdb
import graphlab

import properties


class Recommender:
    def __init__(self, update_caches=False):
        self.item_data = None
        cached_model_directory = "cached_model_" + properties.train_data_directory.replace("/", "_")
        if (os.path.exists(cached_model_directory)) and (not update_caches):
            self.model = graphlab.load_model(cached_model_directory)
        else:
            self.train(properties.ratings_filename, properties.items_info_filename, update_caches)
            self.model.save(cached_model_directory)
            self.create_database()

    def train(self, ratings_filename, items_info_filename, update_caches=False):
        observation_data = Recommender.__load_data(ratings_filename, update_caches)

        self.item_data = Recommender.__load_data(items_info_filename, update_caches)
        self.model = graphlab.recommender.factorization_recommender.create(observation_data,
                                                                           user_id=properties.user_id_header,
                                                                           item_id=properties.item_id_header,
                                                                           target=properties.target_header,
                                                                           item_data=self.item_data,
                                                                           verbose=True,
                                                                           max_iterations=10,
                                                                           solver='sgd')

    def recommend(self, user_ratings=None, k=10):
        if not user_ratings:
            user_ratings = {}
        rated_items = set(user_ratings.keys())
        user_id = [int(Recommender.__get_nearest_neighbor(rated_items))]
        user_ids = user_id * len(user_ratings)
        new_observation_data = graphlab.SFrame({properties.user_id_header: user_ids,
                                                properties.item_id_header: user_ratings.keys(),
                                                properties.target_header: user_ratings.values()})
        recommendations = list(self.model.recommend(user_id, k=k, new_observation_data=new_observation_data,
                                                    verbose=True))
        for recommendation in recommendations:
            item_id = str(recommendation.get(properties.item_id_header))
            if item_id not in rated_items:
                print item_id + "," + str(Recommender.__normalize_score(recommendation.get("score")))

    @staticmethod
    def __load_data(data_path, update_caches=False):
        cached_data_path = data_path + ".cached"
        if (os.path.exists(cached_data_path)) and (not update_caches):
            data = graphlab.SFrame(cached_data_path)
        else:
            data = graphlab.SFrame.read_csv(data_path, delimiter=properties.delimeter_in_string)
            data.save(cached_data_path)
        return data

    @staticmethod
    def __get_nearest_neighbor(user_ratings):
        start_time = time.time()
        ratings_subset_file = open(properties.ratings_subset_filename, "r")
        neighbor_id = -1
        neighbor_intersection = 0
        for user in ratings_subset_file:
            cur_user_ratings = user.split(" ")
            cur_user_id = cur_user_ratings[0]
            cur_user_ratings.pop(0)
            cur_user_ratings.remove('\n')
            # print user_ratings
            # print set(cur_user_ratings)
            intersection = len(user_ratings.intersection(set(cur_user_ratings)))
            if intersection > neighbor_intersection:
                neighbor_intersection = intersection
                neighbor_id = cur_user_id
                # break
        # print "uid: " + str(neighbor_id)
        # print "count: " + str(neighbor_intersection)
        # print("--- %s seconds ---" % (time.time() - start_time))
        return neighbor_id

    def create_database(self):
        db = MySQLdb.connect(host=properties.db_host,
                             user=properties.db_user,
                             passwd=properties.db_passwd)
        cursor = db.cursor()
        cursor.execute("CREATE DATABASE IF NOT EXISTS " + properties.db_name +
                       " CHARACTER SET " + properties.db_charset)
        cursor.execute("USE " + properties.db_name)
        cursor.execute("DROP TABLE IF EXISTS " + properties.db_table_name)
        cursor.execute(
            "CREATE TABLE " + properties.db_table_name + " (" + properties.item_id_header +
            " INT PRIMARY KEY NOT NULL, " +
            properties.db_table_header_title + " VARCHAR(100), " +
            properties.db_table_header_genre + " VARCHAR(200))")

        insert_sql = "INSERT INTO " + properties.db_table_name + "(" + properties.item_id_header \
                     + ", " + properties.db_table_header_title + ", " + properties.db_table_header_genre \
                     + ") VALUES(%s, %s, %s)"

        self.item_data = Recommender.__load_data(properties.items_info_filename)
        for item in list(self.item_data):
            item_id = item.get(properties.item_id_header)
            item_title = item.get(properties.item_title_header)
            item.pop(properties.item_id_header)
            item.pop(properties.item_title_header)
            filtered_dict = {k: v for (k, v) in item.iteritems() if v}
            genres = (reduce(lambda x, key: x + ", " + key, sorted(filtered_dict), "")).partition(" ")[2]
            cursor.execute(insert_sql, (item_id, item_title, genres))

        db.commit()

    @staticmethod
    def __normalize_score(score):
        return round(min(max(score, properties.min_rating), properties.max_rating), 2)


if __name__ == '__main__':
    film_ids = sys.argv[1].split(",")
    ratings = map(int, sys.argv[2].split(","))
    dict_ratings = dict(zip(film_ids, ratings))
    dict_ratings.pop('', None)
    recommender = Recommender(update_caches=False)
    recommender.recommend(user_ratings=dict_ratings, k=20)
    # recommender.create_database()
