<?php

declare(strict_types=1);

namespace Lendable\Greed;

class Greed
{
    public function score(array $dice): int
    {
        global $SCORE;
        $SCORE = 0;

        foreach ($dice as $value) {

            if ($value <= 0) {
                $position = array_search($value, $dice);
                throw new \InvalidArgumentException(sprintf('Die at position %d is invalid.', $position));
            }

            if ($value > 6) {
                $position = array_search($value, $dice);
                throw new \InvalidArgumentException(sprintf('Die at position %d is invalid.', $position));
            }
        }

        if (sizeof($dice) > 6) {
            $numberOfDie = sizeof($dice);
            throw new \InvalidArgumentException(sprintf('Expected a maximum of 6 dice, got %d.', $numberOfDie));
        }

        if (sizeof($dice) == 1) {
            if ($dice[0] === 1) {
                return 100;
            }
            if ($dice[0] === 5) {
                return 50;
            }
        }

        if (sizeof($dice) == 2) {
            if ($dice[0] != $dice[1] && ($dice[0] === 1 || $dice[1] === 1)) {
                $SCORE += 100;
            }
            if ($dice[0] != $dice[1] && ($dice[0] === 5 || $dice[1] === 5)) {
                $SCORE += 50;
            }
        }

        // scoring three/four/five/six 1s

        if (sizeof($dice) >= 3) {
            $j = 0;
            $i = 0;
            $length = sizeof($dice);
            foreach ($dice as $value) {
                $i++;
                if ($j === 0) {
                    $position = $i - 1;
                    if ($value === 1 && $position == ($length - 1) && $dice[$length - 2] != 1) {
                        $SCORE += 100;
                    }
                    if ($value == 1) {
                        $j++;
                    }
                } elseif ($j === 1) {
                    if ($value === 1) {
                        $j++;
                    } else {
                        $SCORE += 100;
                        $j = 0;
                    }
                } elseif ($j === 2) {
                    if ($value === 1) {
                        $j++;
                    } else {
                        $j = 0;
                    }
                } elseif ($j === 3) {
                    if ($value === 1) {
                        $j++;
                    } else {
                        $SCORE += 1000;
                        $j = 0;
                    }
                } elseif ($j === 4) {
                    if ($value === 1) {
                        $j++;
                    } else {
                        $SCORE += 2000;
                        $j = 0;
                    }
                } elseif ($j === 5) {
                    if ($value === 1) {
                        $j++;
                    } else {
                        break;
                    }
                } elseif ($j === 6) {
                    break;
                }
            }
            if ($j === 3) {
                $SCORE += 1000;
            } elseif ($j === 4) {
                $SCORE += 2000;
            } elseif ($j === 5) {
                $SCORE += 4000;
            } elseif ($j === 6) {
                $SCORE += 8000;
            }
        }
        
        // scoring for three/four/five/six 2s
        if (sizeof($dice) >= 3) {
            $i = 0;
            foreach ($dice as $value) {
                if ($i === 0) {
                    if ($value === 2) {
                        $i++;
                    }
                } elseif ($i === 1) {
                    if ($value === 2) {
                        $i++;
                    } else {
                        $i = 0;
                    }
                } elseif ($i === 2) {
                    if ($value === 2) {
                        $i++;
                    } else {
                        $i = 0;
                    }
                } elseif ($i === 3) {
                    if ($value === 2) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 4) {
                    if ($value === 2) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 5) {
                    if ($value === 2) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 6) {
                    break;
                }
            }

            if ($i === 3) {
                $SCORE += 200;
            } elseif ($i === 4) {
                $SCORE += 400;
            } elseif ($i === 5) {
                $SCORE += 800;
            } elseif ($i === 6) {
                $SCORE += 1600;
            }
        }
        // scoring for three/four/five/six 3s
        if (sizeof($dice) >= 3) {

            $i = 0;
            foreach ($dice as $value) {
                if ($i === 0) {
                    if ($value === 3) {
                        $i++;
                    }
                } elseif ($i === 1) {
                    if ($value === 3) {
                        $i++;
                    } else {
                        $i = 0;
                    }
                } elseif ($i === 2) {
                    if ($value === 3) {
                        $i++;
                    } else {
                        $i = 0;
                    }
                } elseif ($i === 3) {
                    if ($value === 3) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 4) {
                    if ($value === 3) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 5) {
                    if ($value === 3) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 6) {
                    break;
                }
            }

            if ($i === 3) {
                $SCORE += 300;
            } elseif ($i === 4) {

                $SCORE += 600;
            } elseif ($i === 5) {

                $SCORE += 1200;
            } elseif ($i === 6) {

                $SCORE += 2400;
            }
        }

//        // scoring for three/four/five/six 4s
        if (sizeof($dice) >= 3) {
            $i = 0;
            foreach ($dice as $value) {
                if ($i === 0) {
                    if ($value === 4) {
                        $i++;
                    }
                } elseif ($i === 1) {
                    if ($value === 4) {
                        $i++;
                    } else {
                        $i = 0;
                    }
                } elseif ($i === 2) {
                    if ($value === 4) {
                        $i++;
                    } else {
                        $i = 0;
                    }
                } elseif ($i === 3) {
                    if ($value === 4) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 4) {
                    if ($value === 4) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 5) {
                    if ($value === 4) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 6) {
                    break;
                }
            }

            if ($i === 3) {

                $SCORE += 400;
            } elseif ($i === 4) {

                $SCORE += 800;
            } elseif ($i === 5) {

                $SCORE += 1600;
            } elseif ($i === 6) {

                $SCORE += 3200;
            }
        }
        // scoring for one/three/four/five/six 5s

        if (sizeof($dice) >= 3) {
            $j = 0;
            $i = 0;
            $length = sizeof($dice);
            foreach ($dice as $value) {
                $i++;
                if ($j === 0) {
                    $position = $i - 1;
                    if ($value === 5 && $position == ($length - 1) && $dice[$length - 2] != 5) {
                        $SCORE += 50;
                    }
                    if ($value == 5) {
                        $j++;
                    }
                } elseif ($j === 1) {
                    if ($value === 5) {
                        $j++;
                    } else {
                        $SCORE += 50;
                        $j = 0;
                    }
                } elseif ($j === 2) {
                    if ($value === 5) {
                        $j++;
                    } else {
                        $j = 0;
                    }
                } elseif ($j === 3) {
                    if ($value === 5) {
                        $j++;
                    } else {
                        $SCORE += 500;
                        $j = 0;
                    }
                } elseif ($j === 4) {
                    if ($value === 5) {
                        $j++;
                    } else {
                        $SCORE += 1000;
                        $j = 0;
                    }
                } elseif ($j === 5) {
                    if ($value === 5) {
                        $j++;
                    } else {
                        break;
                    }
                } elseif ($j === 6) {
                    break;
                }
            }
            if ($j === 3) {
                $SCORE += 500;
            } elseif ($j === 4) {
                $SCORE += 1000;
            } elseif ($j === 5) {
                $SCORE += 2000;
            } elseif ($j === 6) {
                $SCORE += 4000;
            }
        }

        // scoring for three/four/five/six 6s
        if (sizeof($dice) >= 3) {
            $i = 0;
            foreach ($dice as $value) {
                if ($i === 0) {
                    if ($value === 6) {
                        $i++;
                    }
                } elseif ($i === 1) {
                    if ($value === 6) {
                        $i++;
                    } else {
                        $i = 0;
                    }
                } elseif ($i === 2) {
                    if ($value === 6) {
                        $i++;
                    } else {
                        $i = 0;
                    }
                } elseif ($i === 3) {
                    if ($value === 6) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 4) {
                    if ($value === 6) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 5) {
                    if ($value === 6) {
                        $i++;
                    } else {
                        break;
                    }
                } elseif ($i === 6) {
                    break;
                }
            }

            if ($i === 3) {
                $SCORE += 600;
            } elseif ($i === 4) {
                $SCORE += 1200;
            } elseif ($i === 5) {
                $SCORE += 2400;
            } elseif ($i === 6) {
                $SCORE += 4800;
            }


            if (sizeof($dice) == 6) {
                if (sizeof(array_unique($dice)) == 3) {
                    if ($dice[0] === $dice[1] && $dice[2] === $dice[3] && $dice[4] === $dice[5]) {
                        $SCORE = 800;
                    }
                }
            }

            if ($dice === [1, 2, 3, 4, 5, 6]) {
                $SCORE = 1200;
            }
        }
        return $SCORE;
    }
}

$test = new Greed();





