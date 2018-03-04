<?php

namespace Database;

interface IDatabase {
    public function query($command, $params);
    public function seed();
}
