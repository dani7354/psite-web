<?php
    namespace App\Model;

    enum PageType : int
    {
        case Home = 0;
        case Project = 2;
        case Contact = 3;
        case About = 4;
    }
    