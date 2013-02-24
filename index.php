<?php

require_once 'Tweet.php';
require_once 'TwitterSearcher.php';
require_once 'TwitterWordCount.php';
require_once 'WordCounter.php';
require_once 'JsonResponse.php';

TwitterWordCount::run();
