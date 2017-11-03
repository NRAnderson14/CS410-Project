#The new and updated Rent Smart database schema

#Running this WILL DELETE YOUR CURRENT DATABASE, so proceed with caution

DROP DATABASE IF EXISTS rent_smart;
CREATE DATABASE rent_smart;
USE rent_smart;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  username VARCHAR(255) NOT NULL,
  PRIMARY KEY (username),
  password VARCHAR(255) NOT NULL,
  user_type ENUM('tenant', 'landlord') NOT NULL,
  email VARCHAR(255)
);

DROP TABLE IF EXISTS tenants;
CREATE TABLE tenants (
  username VARCHAR(255) NOT NULL,
  PRIMARY KEY (username),
  FOREIGN KEY (username)
    REFERENCES users(username),
  fname VARCHAR(255) NOT NULL,
  lname VARCHAR(255) NOT NULL,
  about_tenant TEXT,
  profile_img_url VARCHAR(255)
);

DROP TABLE IF EXISTS landlords;
CREATE TABLE landlords (
  username VARCHAR(255) NOT NULL,
  PRIMARY KEY (username),
  FOREIGN KEY (username)
    REFERENCES users(username),
  fname VARCHAR(255),
  lname VARCHAR(255),
  company_name VARCHAR(255),
  public_email VARCHAR(255),
  website VARCHAR(255),
  phone VARCHAR(14),
  about_landlord TEXT,
  profile_img_url VARCHAR(255)
);

DROP TABLE IF EXISTS properties;
CREATE TABLE properties (
  property_id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (property_id),
  landlord VARCHAR(255) NOT NULL,
  FOREIGN KEY (landlord)
    REFERENCES landlords(username),
  address VARCHAR(255) NOT NULL,
  apartment VARCHAR(255),
  city VARCHAR(255) NOT NULL,
  state VARCHAR(255) NOT NULL,
  country VARCHAR(255) NOT NULL,
  zip VARCHAR(5) NOT NULL,
  monthly_cost FLOAT NOT NULL,
  is_available BOOLEAN NOT NULL,
  beds TINYINT NOT NULL,
  baths TINYINT NOT NULL,
  water_included BOOLEAN,
  electricity_included BOOLEAN,
  heat_included BOOLEAN,
  trash_included BOOLEAN,
  features TEXT,
  parking TEXT,
  keyword VARCHAR(255)
);

DROP TABLE IF EXISTS friends;
CREATE TABLE friends (
  user_one VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_one)
    REFERENCES tenants(username),
  user_two VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_two)
    REFERENCES tenants(username)
);

DROP TABLE IF EXISTS friend_requests;
CREATE TABLE friend_requests (
  sending_user VARCHAR(255) NOT NULL,
  FOREIGN KEY (sending_user)
    REFERENCES tenants(username),
  receiving_user VARCHAR(255) NOT NULL,
  FOREIGN KEY (receiving_user)
  REFERENCES tenants(username)
);

DROP TABLE IF EXISTS tenant_addresses;
CREATE TABLE tenant_addresses (
  username VARCHAR(255) NOT NULL,
  FOREIGN KEY (username)
    REFERENCES tenants(username),
  property_id INT NOT NULL,
  FOREIGN KEY (property_id)
    REFERENCES properties(property_id),
  is_current_address BOOLEAN NOT NULL
);

DROP TABLE IF EXISTS property_images;
CREATE TABLE property_images (
  property_id INT NOT NULL,
  FOREIGN KEY (property_id)
    REFERENCES properties(property_id),
  image_url VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS landlord_comments;
CREATE TABLE landlord_comments (
  username VARCHAR(255) NOT NULL,
  FOREIGN KEY (username)
    REFERENCES landlords(username),
  user_comment TEXT NOT NULL
);

DROP TABLE IF EXISTS landlord_ratings;
CREATE TABLE landlord_ratings (
  username VARCHAR(255) NOT NULL,
  FOREIGN KEY (username)
    REFERENCES landlords(username),
  user_rating TINYINT NOT NULL
);

DROP TABLE IF EXISTS tenant_comments;
CREATE TABLE tenant_comments (
  username VARCHAR(255) NOT NULL,
  FOREIGN KEY (username)
    REFERENCES tenants(username),
  user_comment TEXT NOT NULL
);

DROP TABLE IF EXISTS tenant_ratings;
CREATE TABLE tenant_ratings (
  username VARCHAR(255) NOT NULL,
  FOREIGN KEY (username)
  REFERENCES tenants(username),
  user_rating TINYINT NOT NULL
);

DROP TABLE IF EXISTS roommates;
CREATE TABLE roommates (
  tenant VARCHAR(255) NOT NULL,
  PRIMARY KEY (tenant),
  FOREIGN KEY (tenant)
    REFERENCES tenants(username),
  property_id INT NOT NULL,
  FOREIGN KEY (property_id)
    REFERENCES properties(property_id)
);

