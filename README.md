<!-- PROJECT LOGO -->
<br />
<div align="center">
  
  <a href="https://github.com/4lena/2022-GP1-2">
    <img src="sprint-0_toxicityInspector/assets/img/logo.png" alt="Logo" width="250" height="250">
  </a>

  <h3 align="center">Toxicity Inspector</h3>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#built-with">Built With</a></li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
  </ol>
</details>

<!-- introduction -->
## About The Project

Most of today's toxicity detection tools do not produce accurate results due to the absence of users' feedback and that is 
why we come up with the idea of Toxicity Inspector. Toxicity Inceptor is a web-based application that inspects the overall 
toxicity level of the comments as well as for other many features. It also uses the advantages of users' feedback to provide 
an accurate result. The main goal of the Toxicity Inceptor is to provide accurate, reliable toxicity detection to those people 
who want to inspect the toxicity of their comments. 

<!-- technology -->
## Built With

* [![My Skills](https://skills.thijs.gg/icons?i=bootstrap,html,css)](https://skills.thijs.gg)
* [![My Skills](https://skills.thijs.gg/icons?i=js,jquery,mongodb)](https://skills.thijs.gg)
* [![My Skills](https://skills.thijs.gg/icons?i=php,python)](https://skills.thijs.gg)


<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

* MongoDB.
* LDA packages.
* Perspective API.
* Visual Studio Code.
* Spyder in Anaconda.
* Localhost server you can use MAMP local server.

### Installation

1. Install the Toxicity Inspector files and store them in your localhost directory.
2. In the Db.php file connect the MongoDB database using your username and password.
   ```sh
   $client = new MongoDB\Client(
    'your connection should be written here'
   );
   ```
3. Run all the Python files in Spyder make sure to edit the directories and to download the required modules <br>to download the modules paste the following code in the terminal:
   ```sh
   pip install module name
   ```
4. Again run all the Python files in Visual Studio Code and also download any required modules by using the previous code.
5. Edit the directories of the Python connection code in the following PHP files:
* overallToxicity.php.
* InspectData.php<br>**For example** edit the following code to match your directory:
   ```sh
   $command = escapeshellcmd('write your directory here  API.py "'.$UploadedFile.'" "'.$fileID.'"');
   ```
6. Finally, run the files using your localhost server.


**Note:** In order to upload the .CSV files you have to locate them in the **Uploads** folder.
