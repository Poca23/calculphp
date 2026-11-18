<?php

verifier('5 - 3', calculer(5, 3, '-'), 2.0);
verifier('5 - 8', calculer(5, 8, '-'), -3.0);
verifier('0 - 0', calculer(0, 0, '-'), 0.0);
verifier('2.5 - 1.5', calculer(2.5, 1.5, '-'), 1.0);