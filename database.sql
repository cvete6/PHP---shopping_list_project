-- Do not forget to create a database called groceries.

-- Before executing the queries, do not forget to select the database for use by uncommenting the line below
-- USE groceries;


-- Table creation
create table if not exists shopping_list
(
	id int auto_increment
		primary key,
	list_name varchar(255) not null,
	creator varchar(255) charset utf8 not null,
	secret varchar(255) charset utf8 not null
)
;

create table if not exists products
(
	id int auto_increment
		primary key,
	product_name varchar(255) charset utf8 not null,
	shopping_list_id int not null,
	quantity int default '1' not null,
	is_bought tinyint(1) default '0' not null,
	is_urgent tinyint(1) default '0' not null,
	created_at datetime not null,
	constraint products_shopping_list_id_fk
		foreign key (shopping_list_id) references shopping_list (id)
)
;


-- Seeding data
INSERT INTO shopping_list (id, list_name, creator, secret) VALUES (1 , 'Tinex', 'boban@boban.com', '662d52f0be33e8158172a4b5dc2fdcc7'); -- The md5 is md5('Tinex')
INSERT INTO shopping_list (id, list_name, creator, secret) VALUES (2, 'Ramstore', 'toso@gmail.com', '6f85151b9fea7da42bb32d6cbad84006')	; -- The md5 hash is md5('Ramstore')

INSERT INTO products (id, product_name, shopping_list_id, quantity, is_bought, is_urgent, created_at) VALUES (1, 'leb', 1, 2, 0, 1, '2018-12-01 09:37:24');
INSERT INTO products (id, product_name, shopping_list_id, quantity, is_bought, is_urgent, created_at) VALUES (2, 'mleko', 1, 1, 0, 1, '2018-12-01 09:38:05');
INSERT INTO products (id, product_name, shopping_list_id, quantity, is_bought, is_urgent, created_at) VALUES (3, 'mastiki', 1, 5, 0, 0, '2018-12-01 09:38:31');
INSERT INTO products (id, product_name, shopping_list_id, quantity, is_bought, is_urgent, created_at) VALUES (4, 'chador', 1, 2, 1, 0, '2018-12-01 09:39:18');
INSERT INTO products (id, product_name, shopping_list_id, quantity, is_bought, is_urgent, created_at) VALUES (5, 'chokolada', 2, 2, 0, 1, '2018-12-01 09:41:01');
INSERT INTO products (id, product_name, shopping_list_id, quantity, is_bought, is_urgent, created_at) VALUES (6, 'sendvich', 2, 1, 1, 0, '2018-12-01 09:41:33');
