<?php
namespace Entities;
/**
* @Entity
* @Table(name="users")
*/
class User
{

        /** @Id @Column(type="integer") @GeneratedValue */
        public $id;

        /** @Column(length=50,nullable=true) */
        public $name;

        /** @Column(length=50) */
        public $login;

        /** @Column(length=32) */
        public $password;

        /** @Column(type="integer") */
        public $role;

}