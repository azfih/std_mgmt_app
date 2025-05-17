pipeline {
  agent any
  environment {
    COMPOSE_CI = 'docker-compose.ci.yml'
    PROJECT_NAME = 'lamp_sec'
  }
  stages {
    stage('Checkout') {
      steps {
        // Checkout code from GitHub repo
        checkout scm
      }
    }
    stage('Build & Deploy App') {
      steps {
        // Stop and remove existing containers with project name, ignoring errors
        sh "docker-compose -p $PROJECT_NAME -f $COMPOSE_CI down --rmi all -v --remove-orphans || true"
        // Build and start containers with new project name
        sh "docker-compose -p $PROJECT_NAME -f $COMPOSE_CI up -d --build"
      }
    }
    stage('Smoke Test') {
      steps {
        // Wait for app to start
        sleep 10
        // Simple curl test to check if app responds with expected content
        sh 'curl -s http://localhost:8090 | grep -i "student"'
      }
    }
  }
  post {
    always {
      // Cleanup containers and resources after pipeline run
      sh "docker-compose -p $PROJECT_NAME -f $COMPOSE_CI down --rmi all -v --remove-orphans"
    }
  }
}
