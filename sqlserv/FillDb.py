#!/usr/bin/python3

from random import shuffle

cpu = ["32", "16", "8"]
ram = ["256", "128", "32"]
usage = ["WEB", "STOCKAGE", "JEU"]
stockage = ["250", "500", "2000"] 
servers= []
user = [1, 2, "NULL"]
i = 0

for s in stockage:
    for u in usage:
        for r in ram:
            for c in cpu:
                if i % 2 == 0:
                    servers.append(f"INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('{u}', '{c}', '{r}', '{s}', 1);")
                else:
                    servers.append(f"INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`, `dispo`) VALUES ('{u}', '{c}', '{r}', '{s}', 0);")
                i += 1

shuffle(servers)

for s in servers:
    print(s)
