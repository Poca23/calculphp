<?php

verifier('4 * 3', calculer(4, 3, '*'), 12.0);
verifier('5 * 0', calculer(5, 0, '*'), 0.0);
verifier('-2 * 3', calculer(-2, 3, '*'), -6.0);
verifier('1.5 * 2', calculer(1.5, 2, '*'), 3.0);