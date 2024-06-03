import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import LabelEncoder
import pickle

data = pd.read_csv('sensor_data.csv')

X = data.iloc[:, 0:6]

y = data.iloc[:, 6]

encoder = LabelEncoder()
y = encoder.fit_transform(y)

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2)

model = RandomForestClassifier(n_estimators=100)

model.fit(X_train, y_train)

predictions = model.predict(X_test)

pkl_filename = "pickle_model.pkl"
with open(pkl_filename, 'wb') as file:
    pickle.dump(model, file)

# Save the encoder
with open('encoder.pkl', 'wb') as file:
    pickle.dump(encoder, file)



with open(pkl_filename, 'rb') as file:
    pickle_model = pickle.load(file)

with open('encoder.pkl', 'rb') as file:
    loaded_encoder = pickle.load(file)

pickle_model.predict(X_test)
