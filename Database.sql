CREATE TABLE users (
  user_id VARCHAR(255),
  PRIMARY KEY (user_id),
  username VARCHAR(255),
  password VARCHAR(255),
  membership_type VARCHAR(255),
  fname VARCHAR(50),
  lname VARCHAR(50),
  email VARCHAR(255)
);

CREATE TABLE tenants (
  user_id VARCHAR(255),
  PRIMARY KEY (user_id),
  FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  fname VARCHAR(255),
  lname VARCHAR(255),
  email VARCHAR(255),
  about_tenant TEXT
);

CREATE TABLE landlords (
  user_id VARCHAR(255),
  PRIMARY KEY (user_id),
  FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  fname VARCHAR(255),
  lname VARCHAR(255),
  company_name VARCHAR(255),
  email VARCHAR(255),
  website VARCHAR(255),
  phone VARCHAR(14),
  about_landlord TEXT
);

CREATE TABLE properties (
  property_id INT,
  address VARCHAR(255),
  city VARCHAR(255),
  apartment_number VARCHAR(255),
  landlord VARCHAR(255),
  monthly_cost INT,
  bedrooms  TINYINT,
  bathrooms TINYINT,
  power_included BOOLEAN,
  water_included BOOLEAN,
  heat_included  BOOLEAN,
  trash_included BOOLEAN,
  features TEXT,
  parking TEXT,
  is_available BOOLEAN,
  image_url VARCHAR(255),
  keyword VARCHAR(255)
);

CREATE TABLE tenant_addresses (
  user_id VARCHAR(255),
  FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  address VARCHAR(255),
  apartment_number VARCHAR(255),
  is_current_address BOOLEAN
);

CREATE TABLE landlord_properties (
  user_id VARCHAR(255),
  FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  address VARCHAR(255)
);

CREATE TABLE landlord_comments (
  user_id VARCHAR(255),
  FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  comment_text TEXT
);

CREATE TABLE tenant_comments (
  user_id VARCHAR(255),
  FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  comment_text TEXT
);

CREATE TABLE landlord_ratings (
  user_id VARCHAR(255),
  FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  rating TINYINT
);

CREATE TABLE tenant_ratings (
  user_id VARCHAR(255),
  FOREIGN KEY (user_id)
  REFERENCES users(user_id),
  rating TINYINT
);

CREATE TABLE friends (
  user_one VARCHAR(255),
  FOREIGN KEY (user_one)
  REFERENCES users(user_id),
  user_two VARCHAR(255),
  FOREIGN KEY (user_two)
  REFERENCES users(user_id)
);

CREATE TABLE roommates (
  user_one VARCHAR(255),
  FOREIGN KEY (user_one)
  REFERENCES users(user_id),
  user_two VARCHAR(255),
  FOREIGN KEY (user_two)
  REFERENCES users(user_id)
);