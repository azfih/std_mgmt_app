pipeline {
  agent any

  environment {
    COMPOSE_CI = 'docker-compose.ci.yml'
    PROJECT_NAME = 'lamp_sec'
  }

  stages {
    
    stage('Checkout Application Code') {
      steps {
        checkout scm
      }
    }

    stage('Build and Deploy Application') {
      steps {
        sh "docker-compose -p $PROJECT_NAME -f $COMPOSE_CI down || true"
        sh "docker-compose -p $PROJECT_NAME -f $COMPOSE_CI up -d --build"
      }
    }

    stage('Smoke Test (Check App is Running)') {
      steps {
        sleep 10 // wait for services to boot up
        sh 'curl -s http://localhost:8090 | grep -i "student"'
      }
    }

    stage('Run Selenium Test Cases') {
      steps {
        dir('test-repo') {
           git branch: 'main', url: 'https://github.com/azfih/std_mgmt_app_testcases.git'
          sh '''
            python3 -m venv selenium-env
            . selenium-env/bin/activate
            pip install -r requirements.txt
            python3 test_app.py
          '''
        }
      }
    }
  }
}
