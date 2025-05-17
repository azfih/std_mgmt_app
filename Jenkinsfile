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
    stage('Clean Environment') {
      steps {
        // Forcefully remove any existing containers with the same names
        sh 'docker rm -f ci_student_web ci_student_db || true'
        sh "docker-compose -f $COMPOSE_CI -p $PROJECT_NAME down -v || true"
      }
    }
    stage('Build & Deploy App') {
      steps {
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
      sh "docker-compose -f $COMPOSE_CI -p $PROJECT_NAME down -v"
      sh 'docker rm -f ci_student_web ci_student_db || true'
    }
  }
}
