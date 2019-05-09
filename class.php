<?php

//==============================================================================================
//                               Creation of the blackjack class
//                            ------------------------------------
//          1 Variable : - Score, Keeps track of the players/dealers score at all time.
//
//          3 Methods  : - Hit, Players draw a card. Score gets updated.
//                       - Stand, Player stops drawing cards, dealer starts his turn.
//                       - Surrender Player gives up, dealer auto wins. (simulate the score).
//==============================================================================================

class Blackjack
{
  public $score = 0;
  public $turn = true;
  public $surr = false;

  function hit()
  {
    $card  = rand(1, 11);
    $this->score = $this->score + $card;
  }

  function stand()
  {
    $this->turn = false;
  }

  function surrender()
  {
    $this->turn = true;
  }
}
