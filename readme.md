# Setup

## Actual setup
```
make setup
```

## Update .ENV
Update .ENV at project root, if following ports are occupied
```
HOST_PORT=8080
REDIS_PORT=6379
MYSQL_PORT=3306
```

# Check PHP app

Open at browser
```
http://localhost:8080
```
## PHP app configs

.ENV
```
LOTTERY_HISTORY_LENGTH = 3
REGISTRATION_LINKS_LIFETIME = 604800 # in seconds, 3 days
```

## Notes


