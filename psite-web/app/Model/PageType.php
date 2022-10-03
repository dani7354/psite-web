<?php
    namespace App\Model;

    enum PageType : int
    {
        case Home = 0;
        case Cv = 1;
        case Project = 2;
        case Contact = 3;
    }
    