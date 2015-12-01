train_data_directory = "train_data/ml-20m/"
ratings_filename = train_data_directory + "ratings.data"
items_info_filename = train_data_directory + "movies.data"
user_id_header = "user_id"
item_id_header = "item_id"
item_title_header = "title"
target_header = "rating"
delimeter_in_string = "|"
min_rating = 0.5
max_rating = 5.0
db_host = "127.0.0.1"
db_user = "user"
db_passwd = "password"
db_name = "recommender"
db_table_name = "movies"
db_table_header_title = "title"
db_table_header_genre = "genre"
db_charset = "utf8"