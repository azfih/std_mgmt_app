pipeline {
  agent any
  environment {
    COMPOSE_CI = 'docker-compose.ci.yml'
    PROJECT_NAME = 'lamp_sec'
  }
  stages {
    stage('Checkout') {
      steps {
        checkout scm
      }
    }
    stage('Build & Deploy App') {
      steps {
        sh "docker-compose -p $PROJECT_NAME -f $COMPOSE_CI down || true"
        sh "docker-compose -p $PROJECT_NAME -f $COMPOSE_CI up -d --build"
      }
    }
    stage('Smoke Test') {
      steps {
        sleep 10
        sh 'curl -s http://localhost:8090 | grep -i "student"'
      }
    }
  }
}
