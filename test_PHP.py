import sys
import json
import time
print(2)
time.sleep(15)
with open("result.txt","w") as f:
    for item in sys.argv:
        f.writelines(item)
print(1)