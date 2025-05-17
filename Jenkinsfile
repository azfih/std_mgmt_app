pipeline {
  agent any

  environment {
    COMPOSE_CI = 'docker-compose.ci.yml'
  }

  stages {
    stage('Checkout') {
      steps {
        checkout scm
      }
    }

    stage('Build & Deploy App') {
      steps {
        sh "docker-compose -f $COMPOSE_CI down || true"
        sh "docker-compose -f $COMPOSE_CI up -d --build"
      }
    }

    stage('Smoke Test') {
      steps {
        // Wait for web container to be ready on port 8090
        sleep 10
        // Hit the web app, not Jenkins UI
        sh 'curl -s http://localhost:8090 | grep "Student Management System"'
      }
    }
  }

  post {
    always {
      sh "docker-compose -f $COMPOSE_CI down"
    }
  }
}
