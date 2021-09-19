# Dockerized LAMP Stack
This setup I’ve been running for over 2 years, so it’s pretty solid, the files you see here are recreation and not a direct copy to protect my production server, but it should still give you a good idea of how to set up something like this. It is based on a LAMP Stack, however, you could base this on any stack. I will assume you have a relatively good understanding of Docker, Docker Compose, Docker Swarm, and GitLab CI/CD as I will not explain these.

Now let me show you around this entire project. It is committed to one git repository. When you run this in your own setup, for this example to work, you will have to have three different git repositories, one for each of the projects in the project folder. And it will have to be on GitLab, however, you could adapt this to run on GitHub by changing the ```.gitlab-ci.yml``` to ```ci.yml``` and make the necessary changes but I will not go into details on how to do that as I do not have any experience with GitHub Actions. And a fourth optional repository to store our configuration files like the ```docker-compose.yml ```, ```.env ```, etc.

## Get Started
Before doing anything, I would recommend going through the entire project and reading the code and the configuration files to get a general understanding of what we’re working with. Once done to get started, go into each of the projects in the project folder and initialize them on GitLab by doing the necessary commits and pushes. And you will have to have two branches, one called staging, and another called production, which should both have commits available. Once that’s done. You can optionally set up your configuration git repository with the configuration files like the compose files, ```.env```. And you will also have to uncomment your .gitignore file before committing your configurations.

Once all this has been done, you should now have 6 different images on your GitLab Container Registry, which you can use for your Docker Swarm, i.e. the staging and production server. Now you'll have to edit the ```staging-stack.yml``` and the ```production-stack.yml``` with the proper image paths. On your servers, you will also have to sign in to your registry so you have access to pull the images down and into your stacks.

Did I lose you yet I know this is a relatively complicated setup if you’re not familiar, so in the future I will make a video on this but if you want such a video to come out faster, you can go comment on my YouTube channel [Vincent Lab](https://www.youtube.com/channel/UCMA8gVyu_IkVIixXd2p18NQ?sub_confirmation=1) and tell me you want such a video and then I mite added to my to-do list.

## Recommendations
For enhancing the setup it would be good to include some kind of reverse proxy, the one I would recommend is [Nginx Proxy Manager](https://nginxproxymanager.com/) as that would allow you to have multiple instances of your application running at the same time which would give you the ability to do rolling updates resulting in zero downtime whenever you run an update.

Another good thing to add would be [Portainer](https://www.portainer.io/) to manage your Docker Swarm.

With Docker, the sky’s the limit.

## Commands

### Docker Compose
```sudo docker-compose up -d --build```
```sudo docker-compose down```

##### These are recommended to only run in a Docker Swarm as they do not work properly with Docker Compose but you can still run them.
```sudo docker-compose -f staging-stack.yml up -d```
```sudo docker-compose -f staging-stack.yml down```

```sudo docker-compose -f production-stack.yml up -d```
```sudo docker-compose -f production-stack.yml down```

### Docker Swarm
```docker stack deploy -c staging-stack.yml```
```docker stack deploy -c production-stack.yml```