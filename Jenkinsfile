pipeline {
  agent any
  environment {
    COMPOSE_CI = 'docker-compose.ci.yml'
    PROJECT_NAME = 'student_app_ci'
  }
  stages {
    stage('Checkout') {
      steps {
        checkout scm
      }
    }
    stage('Build & Deploy App') {
      steps {
        sh "docker-compose -f $COMPOSE_CI -p $PROJECT_NAME down || true"
        sh "docker-compose -f $COMPOSE_CI -p $PROJECT_NAME up -d --build"
      }
    }
    stage('Smoke Test') {
      steps {
        sleep 10
        sh 'curl -s http://localhost:8090 | grep -i "student"'
      }
    }
  }
  post {
    always {
      sh "docker-compose -f $COMPOSE_CI -p $PROJECT_NAME down"
    }
  }
}
