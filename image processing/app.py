
from flask import Flask, request
import cv2

app = Flask(__name__)
print("outside")
@app.route('/image-processing', methods=['POST'])
def predict():


    return 'Image processed successfully!'
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

