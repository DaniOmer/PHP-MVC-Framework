DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS role;
<!--DROP TABLE IF EXISTS role_users;-->
DROP TABLE IF EXISTS validation_tokens;
DROP TABLE IF EXISTS personnel_access_tokens;
DROP TABLE IF EXISTS reset_password;
DROP TABLE IF EXISTS page;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS theme;

---  authentification ----
CREATE TABLE role (
    id SERIAL PRIMARY KEY, 
    name VARCHAR(255) NOT NULL 
    description TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user (
    id SERIAL PRIMARY KEY, 
    role_id INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL, 
    email_verified_at TIMESTAMP, 
    password VARCHAR(255) NOT NULL, 
    <!--is_validated BOOLEAN, -->
    remember_token VARCHAR(255), 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (user_id) REFERENCES user (id)
);

<!--CREATE TABLE role_user (
    user_id INT NOT NULL,
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (role_id) REFERENCES role (id)
);-->

CREATE TABLE validation_tokens (
    id SERIAL PRIMARY KEY,
    user_id INT NULL, 
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (user_id) REFERENCES user (id)
); 

CREATE TABLE reset_password (
    id SERIAAL PRIMAY KEY, 
    user_id INT NOT NULL, 
    token VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE personnel_access_tokens (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL, 
    token VARCHAR(255) NOT NULL, 
    abilities JSONB, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user (id)
);


--- view----
CREATE TABLE page (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL, <!--pour les liens (url)-->
    content TEXT,
    menu_ordre INT, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    FOREIGN KEY (template_id)
)

CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    page_id INT NOT NULL, 
    comment TEXT, 
    is_moderated BOOLEAN, 
    is_flagged BOOLEAN,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (page_id) REFERENCES page (id)
)

CREATE TABLE theme (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    font-familly VARCHAR(255),
    primary_color VARCHAR(255),
    secondary_color VARCHAR(255),
    background_color VARCHAR(255)
)


CREATE TABLE template {
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (page_id) REFERENCES page (id)
}

