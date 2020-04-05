#include <chrono>
#include <iostream>
#include <string>
#include <fstream>
#include "ThreadPool.h"


void executeSystem(std::string command)
{
    system(command.c_str());
}

void x2(double a)
{
    // std::cout << a*a << std::endl;
    for(int i(0); i < 100000000 ; ++i)
       a = a+21323;
    //std::this_thread::sleep_for(std::chrono::milliseconds(2000));
}



int main(int argc, char **argv)
{

    std::cout << "Using at most " << std::thread::hardware_concurrency() << " threads.\n";
    std::cout << argc << " Files in the input: " << argv << std::endl;

    ThreadPool TP(std::thread::hardware_concurrency());
    
    // std::cout << "command" << std::endl;
    std::ifstream inputFile;
    std::vector< std::future<void> > futures;
    for (long long int i = 1; i < argc; ++i) {

        // futures.emplace_back( TP.submit(x2, i) );

        // std::cout << argv[i] << std::endl;

        inputFile.open(argv[i]);
        std::string row;
        while(std::getline(inputFile, row))
        {
            TP.submit(executeSystem, row);
        }
        inputFile.close();
    }

    //readInput(std::cin,commands);
    // do
    // {
    //     std::getline (std::cin, input);
        
    //     commands.push_back(input);

    // } while(input.length() > 0); 

    for( auto& f: futures)
    {
        f.get();
    }
    TP.shutdown();

    return 0;
}