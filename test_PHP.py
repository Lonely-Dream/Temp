import sys
import json
with open("result.txt","w") as f:
    for item in sys.argv:
        f.writelines(item)