import os

import graphlab


class Recommender:
    model_directory = "cached_model"

    def __init__(self):
        pass

    def train(self, ratings_filename, items_info_filename):
        print "hello"


data = graphlab.SFrame.read_csv("/home/darkraven/Prog/RecSys/recommender/train_data/ml-20m/ratings.csv",
                                usecols=['userId', 'movieId', 'rating'])

data.save("/home/darkraven/Prog/RecSys/recommender/train_data/ml-20m/ratings2.csv", format="csv")
