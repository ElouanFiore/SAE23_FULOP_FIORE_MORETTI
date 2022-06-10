CREATE USER 'adminMulticast'@'%' IDENTIFIED BY 'admin';
CREATE USER 'web'@'%' IDENTIFIED BY 'zj%b6zube^&ajd';
GRANT ALL PRIVILEGES ON `multicast`.* TO 'adminMulticast'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON `multicast`.* TO 'web'@'%';

