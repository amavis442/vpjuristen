pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
                cp .env_example .env
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}