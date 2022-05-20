#!/usr/bin/python3

from random import shuffle

cpu = ["32", "16", "8"]
ram = ["256", "128", "32"]
usage = ["WEB", "STOCKAGE", "JEU"]
stockage = ["250", "500", "2000"] 
servers= []

for s in stockage:
    for u in usage:
        for r in ram:
            for c in cpu:
                servers.append(f"INSERT INTO `tle`.`serveurs` (`type`, `cpu`, `ram`, `stockage`) VALUES ('{u}', '{c}', '{r}', '{s}');")

shuffle(servers)

for s in servers:
    print(s)
