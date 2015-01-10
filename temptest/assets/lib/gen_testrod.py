import sys, os
import argparse
import re


current_Z = 0.2
z_matcher = re.compile('G1 Z(.*\..*)( .*)')
gcode_directory = '/var/www/fabui/application/plugins/temptest/assets/lib'


def append(file_read, handle_append):
    fullpath = os.path.join(gcode_directory, file_read)
    r = open(fullpath, 'r')
    for line in r:
        handle_append.write(line)
    r.close()


def append_relative_height(file_read, handle_append):
    global current_Z
    fullpath = os.path.join(gcode_directory, file_read)
    r = open(fullpath, 'r')
    for line in r:
        if line.startswith('G1 Z'):
            line = "G1 Z{0:.3f} F15000.000\n".format(current_Z)
            current_Z += 0.1

        handle_append.write(line)
    r.close()


parser = argparse.ArgumentParser(description='Generate test_rod.gcode.')
parser.add_argument('temps', metavar='N', type=int, nargs='+', help='list of temperatures to test')
parser.add_argument('--bedtemp', dest='bedtemp', help='bed temperature while print')
parser.add_argument('--bedtemp1', dest='bedtemp1', help='bed temperature while first layer print')
parser.add_argument('--temp1', dest='temp1', help='nozzle temperature while first layer print')
parser.add_argument('--file', dest='file', help='output file')
args = parser.parse_args()

tstarg = ["160","165"] 


f = open(args.file, 'w')
f.write('G21 ; set units to millimeters\n')
f.write('M107\n')
f.write('M190 S' + str(args.bedtemp1) + '; wait for bed temperature to be reached\n')
f.write('M104 S' + str(args.temp1) + ' ; set temperature\n')
f.write('M109 S' + str(args.temp1) + ' ; wait for temperature to be reached\n')

append('start.gcode', f)
f.write('\n')

for temp in args.temps:
    f.write('M104 S' + str(temp) + ' ; set temperature\n')
    append_relative_height(str(temp) + '.gcode', f)

f.write('M107')

f.close()  # you can omit in most cases as the destructor will call if

