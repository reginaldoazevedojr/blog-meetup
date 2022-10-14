pipeline {
    agent any

    parameters {
        gitParameter branchFilter: 'origin.*/(.*)', defaultValue: 'main', name: 'BRANCH', type: 'PT_BRANCH'
    }

    stages {
        stage('Build') {
            git branch: "${params.BRANCH}", url: 'https://github.com/reginaldoazevedojr/blog-meetup'
            steps {
                sh "composer install"
            }
        }
    }
}
