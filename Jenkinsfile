pipeline {
    agent any

    environment {
        DB_HOST = "mysql"
        DB_PORT = "3306"
        DB_DATABASE = "perpus"
        DB_USERNAME = "root"
        DB_PASSWORD = "12345678"
    }

    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/NurGhulam04/fp-pso.git', branch: 'main'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install'
                sh 'cp .env.example .env'
                sh 'php artisan key:generate'
            }
        }

        stage('Test') {
            steps {
                sh './vendor/bin/phpunit'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t laravel-app .'
            }
        }

        stage('Deploy') {
            steps {
                sh 'docker-compose down && docker-compose up -d --build'
            }
        }
    }
}
