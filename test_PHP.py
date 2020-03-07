import sys
import json
print(2)
with open("result.txt","w") as f:
    for item in sys.argv:
        f.writelines(item)
print(1)