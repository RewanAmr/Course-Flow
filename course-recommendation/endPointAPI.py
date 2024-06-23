from flask import Flask, request, jsonify
import assemblyai as aai
from flask_cors import CORS
from textblob import TextBlob

app = Flask(__name__)
CORS(app)

@app.route("/process", methods=["POST"])
def main():
    print("Starting the process ...")
    if "file" in request.files:
        print("Voice found !!")
        voice = request.files["file"]
        aai.settings.api_key = "4d1bf5ac60b0463a9f9b6ced95e47402"
        transcriber = aai.Transcriber()
        transcript = transcriber.transcribe(voice)
        print(transcript.text)

        if transcript.text is None:
            return "No transcription found", 204
        else:
            # Remove periods from the text
            text_without_periods = transcript.text.replace('.', '')

            # Correct spelling
            corrected_text = str(TextBlob(text_without_periods).correct())

            # Convert to lowercase
            lowercase_text = corrected_text.lower()

            return lowercase_text, 200
    else:
        return "No voice uploaded!", 400

if __name__ == "__main__":
    app.run(debug=True, port=5055)
