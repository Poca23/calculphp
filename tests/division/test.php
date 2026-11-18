<?php

verifier('8 / 2', calculer(8, 2, '/'), 4.0);
verifier('7 / 2', calculer(7, 2, '/'), 3.5);
verifier('0 / 5', calculer(0, 5, '/'), 0.0);
verifier('5 / 0 (interdit)', calculer(5, 0, '/'), null);