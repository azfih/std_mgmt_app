pipeline {
    agent any

    stages {
        stage('Clone Repository') {
            steps {
                echo 'Code already cloned by Jenkins...'
            }
        }

        stage('Build and Start Services') {
            steps {
                script {
                    sh 'docker-compose -f docker-compose.ci.yml up -d --build'
                }
            }
        }

        stage('Test Web App') {
            steps {
                script {
                    sleep 10 // wait for services to boot
                    sh 'curl -s http://localhost:8080 | grep "Student Management System"'
                }
            }
        }
    }

    post {
        always {
            script {
                sh 'docker-compose -f docker-compose.ci.yml down'
            }
        }
    }
}
