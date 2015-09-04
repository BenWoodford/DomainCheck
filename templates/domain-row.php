<tr class="<?=$classes;?>">
    <td><?php echo $domain; ?></td>
    <?php foreach($results as $result) { ?>
        <td class="result">
            <?php if($result['registered'] == "no"): ?>
                <i class="glyphicon glyphicon-ok"></i>
                <span class="expires"><a target="_blank" href="https://www.namecheap.com/domains/registration/results.aspx?domain=<?=$domain . "." . $result['tld'];?>">Check Price</a></span>
            <?php elseif($result['registered'] == "yes"): ?>
                <i class="glyphicon glyphicon-remove"></i>
                <span class="expires"><a target="_blank" href="http://who.is/whois/<?=$domain . "." . $result['tld'];?>"><?php echo $result['expires']; ?></a></span>
            <?php else: ?>
                <i class="glyphicon glyphicon-warning-sign"></i>
                <span class="expires"><a target="_blank" href="http://who.is/whois/<?=$domain . "." . $result['tld'];?>">Error Querying Domain</a></span>
            <?php endif; ?>
        </td>
    <?php } ?>
</tr>
