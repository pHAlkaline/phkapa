<?php

App::uses('CakeEventManager', 'Event');
App::uses('PrintReportListener', 'PrintReport.Event');

CakeEventManager::instance()->attach(new PrintReportListener());
