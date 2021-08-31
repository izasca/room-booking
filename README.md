# Room Booking Service

REST API with the following features:
1. Ability to create a room with an id, name, number, and occupant (**POST .../api/rooms**)
2. Ability to update a room’s occupant field. (**PUT .../api/rooms/{id}**)
3. Ability to delete a room. (**DELETE .../api/rooms/{id}**)
4. Ability to get a list of all rooms. (**GET .../api/rooms**)

# Language / Frameworks

Developed with PHP and Slim framework, data is persisted in a mysql database.

# Installation

Once the source code is downloaded, install the dependencies with Composer.

```sh
composer install
```

Edit **.env.local** with the mysql parameters. 

# Deployed

[room-booking.izasca.com/api](http://room-booking.izasca.com/api/rooms)