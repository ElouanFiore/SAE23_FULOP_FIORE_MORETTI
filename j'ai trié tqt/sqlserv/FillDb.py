#!/usr/bin/python3

from random import shuffle

cpu = ["32", "16", "8"]
ram = ["256", "128", "32"]
usage = ["WEB", "STOCKAGE", "JEU"]
stockage = ["250", "500", "2000"]
servers= []
i = 0

shuffle(cpu)
shuffle(ram)
shuffle(usage)
shuffle(stockage)
for s in stockage:
    for u in usage:
        for r in ram:
            for c in cpu:
                if i % 2 == 0:
                    servers.append(f"INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('{u}', '{c}', '{r}', '{s}', 1);")
                else:
                    servers.append(f"INSERT INTO `multicast`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `enService`) VALUES ('{u}', '{c}', '{r}', '{s}', 0);")
                i += 1

shuffle(servers)

for s in servers:
    print(s)
print("UPDATE `multicast`.`serveurs`, `multicast`.`locations` SET serveurs.idLocation=locations.id, serveurs.enService=1 WHERE serveurs.id=locations.idServeur;")
