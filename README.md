# CourseFlow Project Setup Guide

This guide provides step-by-step instructions for setting up and running the CourseFlow project.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

1. **Visual Studio Code (VS Code)**
   - [Download Visual Studio Code](https://visualstudio.microsoft.com/vs/)
2. **XAMPP**
   - [Download XAMPP](https://www.apachefriends.org/index.html)
3. **Composer**
   - [Download Composer](https://getcomposer.org/download/)
4. **Python Version 3.9.13**
   - [Download Python](https://www.python.org/downloads/release/python-3913/)

## Setup Instructions

### 1. Download the Project Folder

1. Download the project folder from the repository.
2. Place it in the following path: `C:\xampp\htdocs\`

### 2. Set Up XAMPP

1. Open XAMPP and start the Apache and MySQL modules.

### 3. Upload the Database

1. Open your web browser and go to [phpMyAdmin](http://localhost/phpmyadmin/).
2. Import the ['courseflow.sql'](courseflow.sql) file to create the necessary database.

### 4. Set Up the Virtual Environment and Install Dependencies

1. Open Visual Studio Code (VS Code).
2. Open the project folder: `C:\xampp\htdocs\CourseFlow`
3. Open two terminals in VS Code.

#### Terminal(1) in command prompt:

```cmd
cd C:\xampp\htdocs\CourseFlow\course-recommendation
python -m venv env
env\Scripts\activate
pip install -r requirements.txt
python app.py
```
### Terminal(2) in command prompt:
```cmd
cd C:\xampp\htdocs\CourseFlow\course-recommendation
env\Scripts\activate
python endPointAPI.py
```

### 5. Set Up Forgot Password Functionality
1. Download and install Composer from [https://getcomposer.org/download/].
2. Open a terminal and run the following command to require PHPMailer:
```
composer require phpmailer/phpmailer
```
## Testing and Validation
To ensure that the setup was successful:
1. Check that the Apache and MySQL services are running in XAMPP.
2. Open a web browser and navigate to (http://localhost/courseflow/).
3. Verify that the application loads and functions correctly.
4. Test API endpoints as needed.
## Additional Resources

- **Documentation:** Find detailed project documentation in the ['Documentation'](Resources/CourseFlow.docx) file within the project directory.
- **Presentation:** Access the project presentation file under ['Presentation'](Resources/CourseFlow.pptx) file within the project directory.
- **Demo:** To view a demo of the project, visit [here](https://drive.google.com/drive/folders/1DiZ34kJ2pimCChUkFFK_RWodzU5tJ_fM?usp=sharing).
