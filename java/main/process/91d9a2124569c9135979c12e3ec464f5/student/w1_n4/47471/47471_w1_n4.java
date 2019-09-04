
import java.util.Scanner;

class Main {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        ;
        int A = input.nextInt();
        int B = input.nextInt();
        int C = input.nextInt();
        int m = input.nextInt();
        if (m > 7) {
            float Y = A * (m * m) + B * (m) + C;
            System.out.println("Y = " + Y);
        } else if (m == 7) {
            float Y = A * (m * m) - B * (m) - C;
            System.out.println("Y = " + Y);
        } else if (m < 7) {
            float Y = A * (m * m) + B * (m);
            System.out.println("Y = " + Y);
        }
    }
}
