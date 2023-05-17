import os
from flask import Flask, redirect, render_template, request,jsonify
import CNN
import numpy as np
import torch
import pandas as pd
@app.route('/plantpredict', methods=['POST'])
def plantpredict():
    if request.method == 'POST':
        # print("inside plantpredict")
        dataset = pd.read_csv('Crop_recommendation.csv')
        X = dataset[['ph', 'N','P','K', 'temperature', 'humidity', 'rainfall']]
        y = dataset['label']
        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
        rf = RandomForestClassifier(n_estimators=100, random_state=42)
        rf.fit(X_train, y_train)

        ph = request.form.get('ph')
        n = request.form.get('n')
        p = request.form.get('p')
        k = request.form.get('k')
        humidity = request.form.get('humidity')
        temperature = request.form.get('temperature')
        rainfall = request.form.get('rainfall')
        user_input = pd.DataFrame({'ph': [ph], 'N': [n], 'P': [p], 'K': [k], 'temperature': [temperature], 
                           'humidity': [humidity], 'rainfall': [rainfall]})
        prediction = rf.predict(user_input)
        response = "The predicted plant is: " + prediction[0]
        return response
    else:
        return 'Error: Only POST requests are accepted'
    
if __name__ == '__main__':
    app.run(debug=True)
