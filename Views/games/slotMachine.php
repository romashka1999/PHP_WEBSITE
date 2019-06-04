<?php if (!isLoggedIn()): ?>
    <div class="alert alert-danger">
        <h1>User In not Logged In</h1>
    </div>
<?php endif; ?>
<?php if (isLoggedIn()): ?>
<div class="card border-0 shadow my-5">
    <div class="card-body p-5">
        <table class="table table-striped">
            <thead>
            <tr class="bg-primary">
                <th>Slot Machine</th>
                <th>PayOut</th>
            </tr>
            </thead>
            <tbody class="bg-warning">
            <tr>
                <td>other</td>
                <td>0</td>
            </tr>
            <tr>
                <td>1-1-1</td>
                <td>1</td>
            </tr>
            <tr>
                <td>2-2-2</td>
                <td>2</td>
            </tr>
            <tr>
                <td>3-3-3</td>
                <td>3</td>
            </tr>
            <tr>
                <td>4-4-4</td>
                <td>4</td>
            </tr>
            <tr>
                <td>5-5-5</td>
                <td>5</td>
            </tr>
            <tr>
                <td>6-6-6</td>
                <td>10</td>
            </tr>
            <tr>
                <td>7-7-7</td>
                <td>100</td>
            </tr>
            </tbody>
        </table>


        <form action="/games/slotMachine" method="post">
            <button class="btn btn-danger">1 Crystal</button>
        </form>

        <table class="table table-bordered">
            <tr class="bg-primary">
                <th colspan="3">Slot Machine</th>
            </tr>
            <tr>
                <td id="box1"><?php echo isset($slot1)?$slot1:0;?></td>
                <td id="box2"><?php echo isset($slot2)?$slot2:0?></td>
                <td id="box3"><?php echo isset($slot3)?$slot3:0?></td>
            </tr>
        </table>

        <table class="table table-striped">
            <tr class="bg-primary">
                <th >Balance<i class="far fa-gem"></i></th>
            </tr>
            <tr>
                <td id="userCurrentCristal"><?php echo currentUser('cristal');?></td>
            </tr>
        </table>

        <table class="table table-striped">
            <tr class="bg-primary">
                <th >SumUp</th>
            </tr>
            <tr>
                <td id="sumup"><?php echo isset($sumUp)?$sumUp:"..."?></td>
            </tr>
        </table>
    </div>
</div>
<?php endif; ?>