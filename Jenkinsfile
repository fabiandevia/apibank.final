# jenkins.yml
version: "3.5"

services:
  jenkins:
    image: jenkins/jenkins:lts
    volumes:
     - jenkins_home:/var/jenkins_home
    networks:
     - jenkins

  jenkins-agent:
    build: .
    image: registry.example.com/jenkins-agent
    volumes:
     - /var/run/docker.sock:/var/run/docker.sock
      - /tmp/jenkins:/tmp/jenkins
    secrets:
     - jenkins-password
    networks:
     - jenkins

secrets:
  jenkins-password:
    external: true

volumes:
  jenkins_home:

networks:
 jenkins:
