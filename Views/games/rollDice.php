<?php if (!isLoggedIn()): ?>
    <div class="alert alert-danger">
        <h1>User In not Logged In</h1>
    </div>
<?php endif; ?>
<?php if (isLoggedIn()): ?>
<div class="card border-0 shadow my-5">
    <div class="card-body p-5">
        <form action="/games/rollDice" method="POST">
            <button class="btn btn-danger">1 Crystal</button>
        </form>
        <table class="table table-striped">
            <tr>
                <td>
                    <table class="table table-striped">
                        <tr class="bg-primary">
                            <th >User Dice</th>
                        </tr>
                        <tr>
                            <td id="die1u"><?php echo isset($userDie1)?$userDie1:0;?></td>
                        </tr>
                        <tr>
                            <td id="die2u"><?php echo isset($userDie2)?$userDie2:0;?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-striped">
                        <tr class="bg-primary">
                            <th >Computer Dice</th>
                        </tr>
                        <tr>
                            <td id="die1c"><?php echo isset($computerDie1)?$computerDie1:0;?></td>
                        </tr>
                        <tr>
                            <td id="die2c"><?php echo isset($computerDie2)?$computerDie2:0;?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="bg-primary">
                <th >User Total Score</th>
                <th >Comp Total Score</th>
            </tr>
            <tr>
                <td id="statusu"><?php echo isset($userTotal)?$userTotal:0;?></td>
                <td id="statusc"><?php echo isset($computerTotal)?$computerTotal:0;?></td>
            </tr>
        </table>

        <table class="table table-striped">
            <tr class="bg-primary">
                <th >Balance<i class="far fa-gem"></i></th>
            </tr>
            <tr>
                <td id ="userCurrentCristal"><?php echo currentUser('cristal');?></td>
            </tr>
        </table>

        <table class="table table-striped">
            <tr class="bg-primary">
                <th >Double</th>
            </tr>
            <tr>
                <td id="double"><?php if(isset($double)&&$double == true) echo"You Rolled Double"; else echo "...";?></td>
            </tr>
        </table>

        <table class="table table-striped">
            <tr class="bg-primary">
                <th >SumUp</th>
            </tr>
            <tr>
                <td id="sumup"><?php echo isset($sumUp)?$sumUp:"...";?><p id ="userCurrentCristall"></p></td>
            </tr>
        </table>
        </div>
    </div>
</div>
<?php endif; ?>