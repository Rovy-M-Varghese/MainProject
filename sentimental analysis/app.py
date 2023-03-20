from flask import Flask, request
from textblob import TextBlob
app = Flask(__name__)

@app.route('/sentiment', methods=['POST'])
def sentiment_analysis():
    texts = request.json.get('texts')
    sentiment_scores = []
    for text in texts:
        blob = TextBlob(text)
        sentiment = blob.sentiment.polarity
        sentiment_scores.append(sentiment)
    average_sentiment = sum(sentiment_scores) / len(sentiment_scores)
    response = {
        'positive': len([s for s in sentiment_scores if s > 0]),
        'negative': len([s for s in sentiment_scores if s < 0]),
        'neutral': len([s for s in sentiment_scores if s == 0]),
        'average_sentiment': average_sentiment
    }
    return response

if __name__ == '__main__':
    app.run()