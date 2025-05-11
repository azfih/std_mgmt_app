pipeline {
    agent any

    environment {
        PROJECT_NAME = 'lamp_ci_app'
    }

    stages {
        stage('Clone repository') {
            steps {
                git 'https://github.com/azfih/std_mgmt_app.git'
            }
        }

        stage('Build and Deploy') {
            steps {
                script {
                    sh 'docker-compose down || true' // Stop existing containers
                    sh "docker-compose -p ${env.PROJECT_NAME} -f docker-compose.yml up -d --build"
                }
            }
        }
    }

    post {
        always {
            echo 'Cleaning up...'
        }
        failure {
            echo 'Pipeline failed!'
        }
        success {
            echo 'Pipeline completed successfully!'
        }
    }
}
