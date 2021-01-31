<div class="systemDetails home">
    <table cellpadding="0" cellspacing="0" style="border:1px solid #003D4C"><tr style="background: #85A1A5">
            <td>&nbsp;</td>
            <td style="border-right: 1px solid #003D4C">&nbsp;</td>
                <?php
                $totalTd = 3;
                foreach ($locations as $location) : $totalTd++; ?>
                    <td style="border-right: 1px solid #003D4C"><b><?php echo $location['Location']['location_name']; ?> </b></td>
                <?php endforeach; ?>

            <td><b>Total</b></td></tr>

            <?php
            foreach ($systemStatus as $systems) :
                $totalUsed = 0;
                $totalUnUsed = 0;
                $totalDead = 0;

                ?>
                <tr style="background: #B1B5B5">
                <td style="border-right: 1px solid #003D4C"><b><?php echo $systems['model'];?></b></td>
                <td style="border-right: 1px solid #003D4C"><a style="text-decoration:none" href="SystemDetails/filter/model:<?php echo $systems['modelId']; ?>" target="_blank"><?php echo $systems['allcount'];?></a></td>
                <?php
                    foreach ($systems['location'] as $locId => $systemBylocation) : ?>
                        <td style="border-right: 1px solid #003D4C"><a style="text-decoration:none" href="SystemDetails/filter/model:<?php echo $systems['modelId'];?>/location:<?php echo $locId;?>" target="_blank"><?php echo $systemBylocation;?></a></td>
                    <?php endforeach; ?>

                <td>&nbsp;</td></tr>

                <tr><td style="border-right: 1px solid #003D4C"><b>Used</b></td><td  style="border-right: 1px solid #003D4C">&nbsp;</td>
                <?php
                    foreach ($systems['used'] as $used => $systemUsedBylocation) : ?>
                        <td style="border-right: 1px solid #003D4C"><a style="text-decoration:none" href="SystemDetails/filter/model:<?php echo $systems['modelId'];?>/status:U/location:<?php echo $used;?>" target="_blank">
                            <?php $totalUsed = $totalUsed + $systemUsedBylocation; echo $systemUsedBylocation;?></a></td>
                    <?php endforeach; ?>
                <td><?php echo $totalUsed; ?></td>
                </tr>

                <tr><td style="border-right: 1px solid #003D4C"><b>Working</b></td><td style="border-right: 1px solid #003D4C">&nbsp;</td>
                <?php
                    foreach ($systems['working'] as $used => $systemUsedBylocation) : ?>
                        <td style="border-right: 1px solid #003D4C"><a style="text-decoration:none" href="SystemDetails/filter/model:<?php echo $systems['modelId'];?>/status:W/location:<?php echo $used;?>" target="_blank"><?php $totalUnUsed = $totalUnUsed + $systemUsedBylocation;  echo $systemUsedBylocation;?></a></td>
                    <?php endforeach; ?>
                <td><?php echo $totalUnUsed; ?></td>
                </tr>

                <tr><td style="border-right: 1px solid #003D4C"><b>Not Working</b></td><td style="border-right: 1px solid #003D4C">&nbsp;</td>
                <?php
                    foreach ($systems['notworking'] as $used => $systemUsedBylocation) : ?>
                        <td style="border-right: 1px solid #003D4C"><a style="text-decoration:none" href="SystemDetails/filter/model:<?php echo $systems['modelId'];?>/status:NW/location:<?php echo $used;?>" target="_blank"><?php $totalDead = $totalDead + $systemUsedBylocation;  echo $systemUsedBylocation;?></a></td>
                    <?php endforeach; ?>
                <td><?php echo $totalDead; ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <table cellpadding="0" cellspacing="0" style="border:1px solid #003D4C">
        <tr style="background: #85A1A5">
            <td style="border-right: 1px solid #003D4C; text-align: center; width: 50%;">
                <b>Locations wise Total</b>
            </td>
            <td style="text-align: center; width: 50%;">
                <b>Total Summary</b>
            </td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #003D4C; text-align: center; width: 50%">
                <table>
                    <?php
                    foreach ($locations as $location) : ?>
                        <tr>
                            <td><b><?php echo $location['Location']['location_name'];?></b></td>
                            <td><a href="SystemDetails/filter/location:<?php echo $location['Location']['id'];?>" target="_blank" style="text-decoration: none;"><?php echo $location['Location']['system'];?></a></td>
                        </tr>

                   <?php endforeach; ?>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td><b>Used</b></td>
                        <td><a href="SystemDetails/filter/status:U" target="_blank" style="text-decoration: none;"><?php echo $totalUsedSystems; ?></a></td>
                    </tr>
                    <tr>
                        <td><b>Dead</b></td>
                        <td><a href="SystemDetails/filter/status:NW" target="_blank" style="text-decoration: none;"><?php echo $totalDeadSystems; ?></a></td>
                    </tr>
                    <tr>
                        <td><b>Available</b></td>
                        <td><a href="SystemDetails/filter/status:W" target="_blank" style="text-decoration: none;"><?php echo $totalSystems - $totalUsedSystems - $totalDeadSystems; ?></a></td>
                    </tr>
                    <tr>
                        <td><b>Total Inventory</b></td>
                        <td><a href="SystemDetails/filter/" target="_blank style="text-decoration: none;"><?php echo $totalSystems; ?></a></td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</div>
