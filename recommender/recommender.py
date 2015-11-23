import os

import graphlab

import properties


class Recommender:
    def __init__(self, update_caches=False):
        cached_model_directory = "cached_model_" + properties.train_data_directory.replace("/", "_")
        if (os.path.exists(cached_model_directory)) and (not update_caches):
            self.model = graphlab.load_model(cached_model_directory)
        else:
            self.train(properties.ratings_filename, properties.items_info_filename, update_caches)
            self.model.save(cached_model_directory)

    def train(self, ratings_filename, items_info_filename, update_caches=False):
        observation_data = Recommender.__load_data(ratings_filename, update_caches)
        item_data = Recommender.__load_data(items_info_filename, update_caches)
        self.model = graphlab.recommender.factorization_recommender.create(observation_data,
                                                                           user_id=properties.user_id_header,
                                                                           item_id=properties.item_id_header,
                                                                           target=properties.target_header,
                                                                           item_data=item_data)

    def recommend(self, user_ratings=None, k=10):
        if not user_ratings:
            user_ratings = {}
        user_id = [-1]
        user_ids = user_id * len(user_ratings)
        new_observation_data = graphlab.SFrame({properties.user_id_header: user_ids,
                                                properties.item_id_header: user_ratings.keys(),
                                                properties.target_header: user_ratings.values()})
        print new_observation_data
        recommendations = list(self.model.recommend(user_id, k=k, new_observation_data=new_observation_data))
        print recommendations
        for recommendation in recommendations:
            print str(recommendation.get(properties.item_id_header)) \
                  + " " + str(Recommender.__normalize_score(recommendation.get("score")))

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
    def __normalize_score(score):
        return round(min(max(score, properties.min_rating), properties.max_rating), 2)


r = Recommender()
r.recommend(user_ratings={1: 5, 2: 5, 3: 5}, k=20)
