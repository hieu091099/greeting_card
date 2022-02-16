<?php 
    if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en' || !isset($_SESSION['lang'])){
        $choose     = "Choose Language";
        $taiwanese  = "Taiwanese";
        $english    = "English";
        $vietnamese = "Vietnamese";
        $dash_board = "Dash Board";
        $customer   = "Customers";
        $greeting_card = "Greeting Card";
        $mail       = "Mail";
        $system     = "System";
    }
    if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'tw'){
        $choose     = "选择语言";
        $taiwanese  = "台湾";
        $english    = "英语";
        $vietnamese = "越南语";
        $dash_board = "仪表板";
        $customer   = "顾客";
        $greeting_card = "问候卡";
        $mail       = "邮件";
        $system     = "系统";
    }
    if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'vn'){
        $choose     = "Chon ngon ngu";
        $taiwanese  = "Dai Loan";
        $english    = "Tieng Anh";
        $vietnamese = "Viet Nam";
        $dash_board = "Bang Dieu Khien";
        $customer   = "Khach Hang";
        $greeting_card = "Thiep Chuc Mung";
        $mail       = "Thu";
        $system     = "He Thong";
    }