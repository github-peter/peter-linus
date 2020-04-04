#include <iostream>
#include <stdlib.h> 
#include <string>
#include <vector>
#include <thread>
#include <fstream>


void readInput(std::istream& in, std::vector<std::string>& commands)
{
    std::string row;
    while(std::getline(in, row))
    {
        commands.push_back(row);
    }
}


int main(int argc, char **argv)
{
    std::vector<std::string> commands;
    
    // std::cout << "command" << std::endl;
    std::ifstream inputFile;
    for (int i = 1; i < argc; ++i) {
        std::cout << argv[i] << std::endl;

        inputFile.open(argv[i]);
        readInput(inputFile, commands);
        inputFile.close();
    }

    //readInput(std::cin,commands);
    // do
    // {
    //     std::getline (std::cin, input);
        
    //     commands.push_back(input);

    // } while(input.length() > 0); 


    for(auto& n : commands)
    {
        // std::cout << n << std::endl;
        system(n.c_str());
    }


    return 0;
}