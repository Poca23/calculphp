<?php

verifier('5 + 3', calculer(5, 3, '+'), 8.0);
verifier('0 + 0', calculer(0, 0, '+'), 0.0);
verifier('-2 + 2', calculer(-2, 2, '+'), 0.0);
verifier('2.5 + 1.5', calculer(2.5, 1.5, '+'), 4.0);