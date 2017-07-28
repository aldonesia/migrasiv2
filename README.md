## migrasiv2
project migrasi v2

# buat user

INSERT INTO `user`(`id_user`, `id_mitra`, `id_role_user`, `username_user`, `password_user`, `nama_user`, `no_telepon_user`) VALUES ('102','MITRA00','RO1','aldo',md5('123'),'rizky fenaldo m','14045');
INSERT INTO `user`(`id_user`, `id_mitra`, `id_role_user`, `username_user`, `password_user`, `nama_user`, `no_telepon_user`) VALUES ('102','MITRA00','RO2','sani',md5('123'),'abdul majid hasani','14022');
INSERT INTO `user`(`id_user`, `id_mitra`, `id_role_user`, `username_user`, `password_user`, `nama_user`, `no_telepon_user`) VALUES ('103','MITRA00','RO3','glleen',md5('123'),'glleen allan hasani','12345');
INSERT INTO `user`(`id_user`, `id_mitra`, `id_role_user`, `username_user`, `password_user`, `nama_user`, `no_telepon_user`) VALUES ('104','MITRA00','RO4','nezar',md5('123'),'M nezar mahardika','54321');
INSERT INTO `user`(`id_user`, `id_mitra`, `id_role_user`, `username_user`, `password_user`, `nama_user`, `no_telepon_user`) VALUES ('105','MITRA00','RO5','hamka',md5('123'),'hamka aminullah','98765');
INSERT INTO `user`(`id_user`, `id_mitra`, `id_role_user`, `username_user`, `password_user`, `nama_user`, `no_telepon_user`) VALUES ('106','MITRA00','RO6','faiq',md5('123'),'faiq firdausi','56789');
INSERT INTO `user`(`id_user`, `id_mitra`, `id_role_user`, `username_user`, `password_user`, `nama_user`, `no_telepon_user`) VALUES ('107','MITRA01','RO7','pranawa',md5('123'),'pranawa','14033');
INSERT INTO `user`(`id_user`, `id_mitra`, `id_role_user`, `username_user`, `password_user`, `nama_user`, `no_telepon_user`) VALUES ('108','MITRA01','RO8','mujib',md5('123'),'mujib','14044');



# buat table session

CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

ALTER TABLE `transaksi` ADD PRIMARY KEY(`ND`);
